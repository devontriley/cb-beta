<?php
$header = get_sub_field('header');
$copy = get_sub_field('copy');
$postFormCopy = get_sub_field('post_form_copy');
?>

<div class="module-form">
    <div class="module-form__inner">
        <div class="module-form__form-container">
            <h2 class="module-form__header"><?php echo $header ?></h2>
            <div class="module-form__copy">
                <?php echo $copy ?>
            </div>

            <form class="module-form__form">
                <div class="module-form__field">
                    <label class="module-form__label">First Name:</label>
                    <input name="fname" type="text" placeholder="Sarah" required />
                </div>

                <div class="module-form__field">
                    <label class="module-form__label">Last Name:</label>
                    <input name="lname" type="text" placeholder="Williams" required />
                </div>

                <div class="module-form__field">
                    <label class="module-form__label">Email Address:</label>
                    <input name="email" type="email" placeholder="sarah@williams.com" required />
                </div>

                <div class="module-form__field">
                    <label class="module-form__label">Phone Number:</label>
                    <input name="phone1" type="text" size="3" required />
                    <input name="phone2" type="text" size="3" required />
                    <input name="phone3" type="text" size="4" required />
                </div>

                <div class="module-form__field">
                    <label class="module-form__label">Message:</label>
                    <textarea name="message" placeholder="Hello"></textarea>
                </div>

                <div class="module-form__field">
                    <label class="module-form__label">I want to:</label>
                    <input name="work_with_you" type="checkbox" id="work_with_you" /><label for="work_with_you">Work with you (client/vendor)</label>
                    <input name="other" type="checkbox" id="other" /><label for="other">Work with you (client/vendor)</label>
                </div>

                <div class="module-form__field">
                    <button type="submit">Submit ></button>
                </div>
            </form>

            <?php echo $postFormCopy ?>
        </div>

        <div class="module-form__callout">
            <h2>Looking to work at CB?</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy.</p>
            <a class="btn" href="<?php bloginfo('url'); ?>/careers">
                <span>See openings</span>
                <svg class="arrow arrow-right" viewBox="0 0 32 14">
                    <use xlink:href="#arrow-right"></use>
                </svg>
            </a>
        </div>
    </div>
</div>
