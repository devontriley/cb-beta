import { encodeHTML } from './utils.js';

setTimeout(function()
{

    if(typeof Marionette === 'undefined') return false;

    let nonce = active_campaign_nonce.ac_nonce;

    /**
     * Create a new object for custom validation of a custom field.
     */
    let mySubmitController = Marionette.Object.extend(
        {
        initialize: function()
        {
            this.listenTo(Backbone.Radio.channel( 'forms' ), 'submit:response', this.actionSubmit);
        },

        actionSubmit: function(response)
        {
            let errors = response.errors;

            if(errors.length > 0) return false;

            // Fire GTM custom form submission event
            if(dataLayer)
            {
                dataLayer.push({
                    'event': 'formSubmission',
                    'eventCategory': 'KPI',
                    'eventAction': 'KPI',
                    'eventLabel': 'Contact Form Confirmation Success'
                });
            }

            let fields = response.data.fields;
            let values = Object.values(fields);
            let email = null;
            let fname = null;
            let lname = null;
            let phone = null;
            let message = null;
            let iam = null;
            let company = null;
            let department = null;
            let cboptin = null;

            console.log(values);

            for(let i = 0; i < values.length; i++)
            {
                if(values[i].key !== '' && values[i].value !== false)
                {
                    console.log(i, values[i].value);

                    if(values[i].key === 'email_address_1550183934916') email = (typeof values[i].value === 'string') ? encodeHTML(values[i].value) : values[i].value;
                    if(values[i].key === 'first_name_1550183929490') fname = (typeof values[i].value === 'string') ? encodeHTML(values[i].value) : values[i].value;
                    if(values[i].key === 'last_name_1550183932520') lname = (typeof values[i].value === 'string') ? encodeHTML(values[i].value) : values[i].value;
                    if(values[i].key === 'phone_number_1550183936771') phone = (typeof values[i].value === 'string') ? encodeHTML(values[i].value) : values[i].value;
                    if(values[i].key === 'message_optional_1550668364873') message = (typeof values[i].value === 'string') ? encodeHTML(values[i].value) : values[i].value;
                    if(values[i].key === 'i_am_a_1549812855379') iam = (typeof values[i].value === 'string') ? encodeHTML(values[i].value) : values[i].value;
                    if(values[i].key === 'company_1549813216534') company = (typeof values[i].value === 'string') ? encodeHTML(values[i].value) : values[i].value;
                    if(values[i].key === 'department_1549997393565') department = (typeof values[i].value === 'string') ? encodeHTML(values[i].value) : values[i].value;
                    if(values[i].key === 'yes_i_want_to_opt_in_for_emails_1549942089880') cboptin = (typeof values[i].value === 'string') ? encodeHTML(values[i].value) : ((values[i].value === 1) ? 'Yes' : null);
                }
            }

            console.log(email, fname, lname, phone, message, iam, company, department, cboptin);

            $.ajax({
                url: ajaxurl,
                method: 'POST',
                data:{
                    'action' : 'get_request',
                    'security': nonce,
                    'email': email,
                    'fname': fname,
                    'lname': lname,
                    'phone': phone,
                    'message': message,
                    'iam': iam,
                    'company': company,
                    'department': department,
                    'cboptin': cboptin
                }
            }).done( function ( response )
            {
                console.log(response);

                let json = JSON.parse(response);
                    json = JSON.parse(json);
            } );
        }
    });

    jQuery(document).ready(function($)
    {
        new mySubmitController();
    });

}, 3000);