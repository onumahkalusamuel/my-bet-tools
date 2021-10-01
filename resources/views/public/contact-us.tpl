<main role="main">
    {include file="public/components/page-title-component.tpl" title="contact us"}


    <div class="row m-0 text-center">
        <div class="col-6 pl-0 py-3">
            <div class="br-0 border px-2 py-4">
                <div class="bi bi-phone text-danger"></div>
                <h4 class="font-weight-bold">Email</h4>
                <a class="btn border border-dark" href="mailto:info@onumahkalusamuel.tk">info@onumahkalusamuel.tk</a>
            </div>
        </div>
        <div class="col-6 pr-0 py-3">
            <div class="br-0 border px-2 py-4">
                <div class="bi bi-whatsapp text-success"></div>
                <h4 class="font-weight-bold">Social</h4>
                <div class="row m-0 px-5 justify-content-between">
                    <a class="btn p-0" target="_blank" href="#">
                        <img width="38px" height="38px" src="img/facebook.svg" />
                    </a>
                    <a class="btn p-0" target="_blank" href="#">
                        <img width="38px" height="38px" src="img/telegram.svg" />
                    </a>
                    <a class="btn p-0" target="_blank" href="#">
                        <img width="38px" height="38px" src="img/instagram.svg" />
                    </a>
                    <a class="btn p-0" target="_blank" href="#">
                        <img width="38px" height="38px" src="img/twitter.svg" />
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-0 mb-5 text-center">
        <div class="col px-0 py-3">
            <div class="br-0 border p-3 py-4">
                <div class="bi bi-envelope text-info" style="font-size:2rem;"></div>
                <h4 class="font-weight-bold">Direct Message</h4>

                <form id="contact-form" class="mt-4" method="POST" action="{$route->urlFor('contact-us')}"
                    onsubmit="return ajaxPost('contact-form');">
                    <div class="row text-left">
                        <div class="form-group col-6">
                            <label for="name" class="sr-only">Your Name *</label>
                            <input class="form-control" name="name" id="name" placeholder="Enter your name" required />
                        </div>
                        <div class="form-group col-6">
                            <label for="email" class="sr-only">Your Email *</label>
                            <input class="form-control" name="email" type="email" id="email"
                                placeholder="Enter your email address" required />
                        </div>
                        <div class="form-group col-12">
                            <label for="subject" class="sr-only">Your Subject *</label>
                            <input class="form-control" name="subject" type="text" id="subject"
                                placeholder="Enter the subject of this message" required />
                        </div>
                        <div class="form-group col-12">
                            <label for="message" class="sr-only">Your Message *</label>
                            <textarea class="form-control text-center" name="message"
                                placeholder="Enter your message here."></textarea>
                        </div>
                        <div class="form-group text-center col-12 row m-0">
                            <div class="col-6 pl-0">
                                <button type="submit" class="btn btn-block btn-success">Submit</button>
                            </div>
                            <div class="col-6 pr-0">
                                <button type="reset" class="btn btn-block btn-danger">Clear</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>