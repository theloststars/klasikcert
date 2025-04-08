
<div class="rts-testimonials-h2-area rts-section-gap bg_testimonials-h2">
        <div class="container">
            <div class="row align-items-center  bg-secondary">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="p-5">
                <div class="align-items-start d-flex">
                    <h4 class="me-3 mt-2 pt-5 m-3 text-white"><i class="fa fa-solid fa-map" style="font-size: 15px"></i></h4>
                    <h5 class="pl-3 pt-5 m-3 text-white">
                        <span class="fw-bold" style="font-weight: bold">office</span><br />
                        <span>Panama City, Oceania Punta Pacifica</span>
                    </h5>
                </div>

                <div class="align-items-start d-flex">
                    <h4 class="me-3 mt-2 pt-5 m-3 text-white"><i class="fa fa-solid fa-envelope-open-text"
                            style="font-size: 15px"></i></h4>
                    <h5 class="pl-3 pt-5 m-3 text-white">
                        <span class="fw-bold" style="font-weight: bold">Email</span><br /><a
                            href="mailto:info@sentralsistemindonesia.com">office@ssabaccreditation.com</a>
                    </h5>
                </div>
            </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="contact-form-area-one">
                        <div class="rts-title-area contact text-start">
                            <p class="pre-title">
                            Send a Message Through Our Website
                            </p>
                            <h2 class="title">Fill The Form Below</h2>
                        </div>
                        <div id="form-messages"></div>
                        <form class="contact-form" method="POST" action="{{ route('contactus.email') }}?notCheck=1">
                    @csrf
                    {{-- <input type="hidden" name="_token" value="ZFgPRi5EZHLz8uSldspPZN9Qwm919I1v1PRaAoYg" /> --}}
                    <input class="contact-input shadow-none border-0 form-control" type="text"
                        placeholder="Company Name" aria-label="company-name" name="company_name" required />

                    <input class="contact-input shadow-none border-0 form-control" type="text"
                        placeholder="Your Name" aria-label="your-name" name="name" required />

                    <input class="contact-input shadow-none border-0 form-control" type="text" placeholder="Location"
                        aria-label="location" name="location" required />

                    <input class="contact-input shadow-none border-0 form-control" type="text"
                        placeholder="Phone Number" aria-label="phone-number" name="phone" required />

                    <textarea name="message" id="" cols="30" rows="3"
                        class="contact-input shadow-none border-0" placeholder="Message"></textarea>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="rts-btn btn-primary-2">
                            Send
                        </button>
                    </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
</div>
