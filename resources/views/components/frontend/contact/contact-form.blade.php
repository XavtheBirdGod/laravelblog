<section class="contact-area py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">

                <div class="mb-5 pb-3" style="border-bottom: 3px double #1a1a1a;">
                    <p class="text-uppercase mb-1" style="font-size: 11px; font-weight: 700; color: #888; letter-spacing: 2px;">The Gazette</p>
                    <h1 class="font-weight-bold mb-3" style="font-family: 'serif'; font-size: 42px; color: #1a1a1a;">Contact</h1>
                    <p class="font-italic" style="font-size: 16px; color: #555; line-height: 1.6;">
                        Heeft u een nieuwstip of een vraag voor onze redactie? Vul het onderstaande formulier in en wij nemen zo spoedig mogelijk contact met u op.
                    </p>
                </div>

                <div class="p-4 p-md-5" style="background-color: #fafaf8; border: 1px solid #d1cfc9;">

                    @if(session('status'))
                        <div class="alert alert-success mb-4 rounded-0" style="border-left: 4px solid #2d6a2d;">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('frontend.contact.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="name" class="text-uppercase d-block mb-2" style="font-size: 12px; font-weight: 800; letter-spacing: 1px;">Naam</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Uw volledige naam"
                                       class="form-control"
                                       style="height: 50px; border-radius: 0; border: 1px solid #aaa; background: #fff; padding: 10px 15px;">
                                @error('name') <small class="text-danger mt-1"><i>{{ $message }}</i></small> @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="email" class="text-uppercase d-block mb-2" style="font-size: 12px; font-weight: 800; letter-spacing: 1px;">E-mail</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="u@voorbeeld.nl"
                                       class="form-control"
                                       style="height: 50px; border-radius: 0; border: 1px solid #aaa; background: #fff; padding: 10px 15px;">
                                @error('email') <small class="text-danger mt-1"><i>{{ $message }}</i></small> @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label for="message" class="text-uppercase d-block mb-2" style="font-size: 12px; font-weight: 800; letter-spacing: 1px;">Bericht</label>
                                <textarea name="message" id="message" rows="6" placeholder="Typ hier uw vraag of nieuwstip..."
                                          class="form-control"
                                          style="border-radius: 0; border: 1px solid #aaa; background: #fff; padding: 10px 15px; min-height: 150px;">{{ old('message') }}</textarea>
                                @error('message') <small class="text-danger mt-1"><i>{{ $message }}</i></small> @enderror
                            </div>

                            <div class="col-12 text-right">
                                <button type="submit" class="btn text-uppercase font-weight-bold"
                                        style="background-color: #f6003c; color: #fff; padding: 12px 35px; border-radius: 0; border: none; letter-spacing: 1px; font-size: 14px;">
                                    Verzenden <i class="fa fa-angle-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
