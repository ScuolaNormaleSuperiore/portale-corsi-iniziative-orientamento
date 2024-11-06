<!-- block : contact -->
<div id="section_contact" class="section mt-1 bg-light">
    <div class="container">

        <div class="row">

            <div class="col-12 col-lg-6 mb-5">

                <h2 class="fw-bold mb-0">{{__('fe.contattaci')}}</h2>
                <p class="fw-medium mb-5">{{__('fe.facci_sapere')}}</p>

                <div class="row">

                    <!-- call us -->
                    <div class="col-12 col-sm-6 mb-4">

                        <h3 class="fw-medium text-primary h5 mb-4">
                            {{__('fe.chiamaci')}}
                        </h3>

                        <p class="m-0">
                            <a href="tel:01555-88978" class="link-muted">+01 785-388-9450</a>
                        </p>
                        <p class="m-0">
                            <a href="email:john.doe@gmail.com" class="link-muted">john.doe@gmail.com</a>
                        </p>

                    </div>

                    <!-- address -->
                    <div class="col-12 col-sm-6 mb-4">

                        <h3 class="fw-medium text-primary h5 mb-4">
                            Our Address
                        </h3>

                        <p class="m-0">
                            Road 741, No.44, New York <br>
                            United States
                        </p>

                    </div>
                </div>



                <div class="bg-white shadow-primary-xs rounded p-2 mt-5">

                    <!--
                      Map
                    -->
                    <div class="map-leaflet w-100 rounded" style="height:400px"
                         data-map-tile="voyager"
                         data-map-zoom="8"
                         data-map-json='[
                    {
                      "map_lat": 40.750765,
                      "map_long": -73.993428,
                      "map_popup": "<b>Smarty Inc.</b> <br> Road 741, No.44,<br> New York / United States <br> <a href=`tel:7853889450`>(01)-785-388-9450</a>"
                    }
                  ]'><!-- map container--></div>

                </div>

            </div>

            <div class="col-12 col-lg-6">

                <div class="rounded bg-white shadow-xs d-flex">
                    <div class="m-5 m-4-xs">

                        <h2 class="mb-4">
                            {{__('fe.mandaci_un_messaggio')}}
                        </h2>


                        <!--
                          CONTACT FORM : AJAX [TESTED|WORKING AS IT IS]

                            Plugin required: SOW Ajax Forms

                            In order to work as ajax form, SOW Ajax Forms should be available/enabled
                            Else, SOW Form Validation plugin is used.
                            If none of them are available, normal submit is used and you can remove:
                              .js-ajax
                              .bs-validate
                              novalidate
                              any data-ajax-*
                              any data-error-*

                            ** Remove data-error-toast-* for no error toast notifications




                          Ajax will control success/fail alerts according to server response:

                            1. unexpected error:    if server response is this string: {:err:unexpected:}
                            2. mising mandatory:    if server response is this string: {:err:required:}
                            3. success:         if server response is this string: {:success:}

                            data-ajax-control-alerts="true"
                            data-ajax-control-alert-succes="#contactSuccess"
                            data-ajax-control-alert-unexpected="#contactErrorUnexpected"
                            data-ajax-control-alert-mandaroty="#contactErrorMandatory"

                          +++++++++++++++++++++++++++++++++++++++++++++++++++++++
                            WORKING CONTACT! Edit your php/config.inc.php
                          +++++++++++++++++++++++++++++++++++++++++++++++++++++++
                        -->
                        <form   novalidate
                                action="php/contact_form.php"
                                method="POST"

                                data-ajax-container="#ajax_dd_contact_response_container"
                                data-ajax-update-url="false"
                                data-ajax-show-loading-icon="true"
                                data-ajax-callback-function=""
                                data-error-scroll-up="false"

                                data-ajax-control-alerts="true"
                                data-ajax-control-alert-succes="#contactSuccess"
                                data-ajax-control-alert-unexpected="#contactErrorUnexpected"
                                data-ajax-control-alert-mandaroty="#contactErrorMandatory"

                                data-error-toast-text="<i class='fi fi-circle-spin fi-spin float-start'></i> Please, complete all required fields!"
                                data-error-toast-delay="2000"
                                data-error-toast-position="bottom-center"

                                class="bs-validate js-ajax">


                            <!-- 1.
                              optional, hidden action for your backend

                              PHP Basic Example
                              if($_POST['action'] == 'contact_form_submit') {
                                ... send message
                              }
                            -->
                            <input type="hidden" name="action" value="contact_form_submit" tabindex="-1">
                            <!-- -->


                            <!-- 2.
                              A very small optional trick (using .hide class instead of type="hidden") for some low spam robots.
                              If this is not empty, the process should stop. A normal user/visitor should not be able to see this field.

                              PHP Basic Example
                              if($_POST['norobot'] != '') {
                                exit;
                              }
                            -->
                            <input type="text" name="norobot" value="" class="hide" tabindex="-1">
                            <!-- -->

                            <div class="form-floating mb-3">
                                <input required placeholder="Name" id="contact_name" name="contact_name" type="text" class="form-control">
                                <label for="contact_name">Name</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input required placeholder="Email" id="contact_email" name="contact_email" type="email" class="form-control">
                                <label for="contact_email">Email</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input required placeholder="Phone" id="contact_phone" name="contact_phone" type="text" class="form-control">
                                <label for="contact_phone">Phone</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea required placeholder="Message" id="contact_message" name="contact_message" class="form-control" rows="3" style="min-height:120px"></textarea>
                                <label for="contact_message">Message</label>
                            </div>

                            <!-- GDPR CONSENT -->
                            <div class="mb-3 border p-3 rounded">

                                <p class="small mb-3 pb-3 border-bottom">
                                    I consent that my personal data is stored according to <span class="fw-medium">2016/679/UE (UE GDPR)</span>.
                                </p>

                                <div class="form-check">
                                    <input required class="form-check-input" id="contact_gdpr" name="contact_gdpr" type="checkbox" value="1">
                                    <label class="form-check-label" for="contact_gdpr">
                                        I do accept Smarty <a class="text-decoration-none" href="shop-page-terms.html" target="_blank">terms & conditions</a>.
                                    </label>
                                </div>

                            </div>
                            <!-- /GDPR CONSENT -->




                            <!--
                              Server detailed error
                              !ONLY! If debug is enabled!
                              Else, shown ony "Server Error!"
                            -->
                            <div id="ajax_dd_contact_response_container"></div>

                            <!-- {:err:unexpected:} internal server error -->
                            <div id="contactErrorUnexpected" class="hide alert alert-danger p-3">
                                Unexpected Error!
                            </div>

                            <!-- {:err:required:} mandatory fields -->
                            <div id="contactErrorMandatory" class="hide alert alert-danger p-3">
                                Please, review your data and try again!
                            </div>

                            <!-- {:success:} message sent -->
                            <div id="contactSuccess" class="hide alert alert-success p-3">
                                Thank you for your message!
                            </div>




                            <button type="submit" class="btn btn-lg btn-primary w-100">
                                Send Message
                            </button>

                        </form>
                        <!-- /CONTACT FORM : AJAX -->


                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
<!-- /block : contact -->
