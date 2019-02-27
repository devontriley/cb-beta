<?php

header('Access-Control-Allow-Origin: *');

add_action('wp_ajax_nopriv_get_request', 'get_request');
add_action('wp_ajax_get_request', 'get_request');

function get_request()
{
    $apiData = new ActiveCampaignAPIRequest;
}

class ActiveCampaignAPIRequest {
    private $api_key;

    function __construct() {
        $checkNonce = check_ajax_referer( 'wp_rest', 'security', false );

        if(!$checkNonce || $checkNonce === '')
        {
            return false;
            wp_die();
        }

        $this->api_key = getenv('CB_ACTIVE_CAMPAIGN_KEY');

        $data = $this->filter_request();

        echo json_encode($data);

        wp_die();
    }

    function filter_request() {
        $responses = array();

        $createUser = $this->get_curl_request('https://cambridgebiomarketing.api-us1.com/api/3/contact/sync', 'create');
        array_push($responses, $createUser);
        $userJSON = json_decode($createUser);
        $id = $userJSON->contact->id;

        if($id)
        {

            $data = $this->get_curl_request('https://cambridgebiomarketing.api-us1.com/api/3/contactLists', 'update', $id);
            $customFields = $this->get_curl_request('https://cambridgebiomarketing.api-us1.com/api/3/fieldValues', 'customFields', $id);

            array_push($data, $responses);
            array_push($customFields, $responses);

            return $responses;
        }
    }

    function get_curl_request($url, $action, $id = null)
    {
        if($action === 'create')
        {
            $ch = curl_init();

            $email = $_POST['email'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $phone = $_POST['phone'];

            $body = json_encode(array(
                "contact" => array(
                    "email" => $email,
                    "firstName" => $fname,
                    "lastName" => $lname,
                    'phone' => $phone
                )
            ));

            curl_setopt_array($ch, array(
                CURLOPT_HTTPHEADER => array(
                    'Api-Token: '.$this->api_key,
                    'Content-Type: application/json',
                    'Content-Length: '.strlen($body)
                ),
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_POST => 1,
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => 1
            ));

            $result = curl_exec($ch);

            curl_close($ch);

            return $result;
        }

        if($action === 'update')
        {
            $ch = curl_init();

            $body = json_encode(array(
                "contactList" => array(
                    "list" => 9,
                    "contact" => $id,
                    "status" => 1
                )
            ));

            curl_setopt_array($ch, array(
                CURLOPT_HTTPHEADER => array(
                    'Api-Token: '.$this->api_key,
                    'Content-Type: application/json',
                    'Content-Length: '.strlen($body)
                ),
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_POST => 1,
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => 1
            ));

            $result = curl_exec($ch);

            curl_close($ch);

            return $result;
        }

        if($action === 'customFields')
        {
            $customFieldResults = array();
            $customFields = array(
                '9' => $_POST['message'], // string
                '10' => $_POST['iam'], // option id
                '4' => $_POST['company'], // string
                '12' => $_POST['department'], // option id
                '14' => $_POST['cboptin'] // boolean
            );

            foreach($customFields as $k => $v)
            {
                $ch = curl_init();

                $body = json_encode(array(
                    "fieldValue" => array(
                        "contact" => $id,
                        "field" => $k,
                        "value" => $v
                    )
                ));

                curl_setopt_array($ch, array(
                    CURLOPT_HTTPHEADER => array(
                        'Api-Token: '.$this->api_key,
                        'Content-Type: application/json',
                        'Content-Length: '.strlen($body)
                    ),
                    CURLOPT_POSTFIELDS => $body,
                    CURLOPT_POST => 1,
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => 1
                ));

                array_push($customFieldResults, curl_exec($ch));

                curl_close($ch);
            }

            return $customFieldResults;
        }
    }
}
?>