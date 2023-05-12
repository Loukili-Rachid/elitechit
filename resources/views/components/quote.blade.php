<!-- Quote Section -->
    <div class="quote-part mfp-hide" id="quote-popup">
        <div class="container">
            <div class="section-title"> <span class="section-span">Get A Quote</span> </div>
            <div class="row">
                <div class="col-lg-12">
                    <form class="quote-form" method="POST" action="{{route('quote')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <input value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" type="text" name="name"placeholder="Name" required>
                            </div>
                            <div class="col-md">
                                <input value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" type="text" name="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <input value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" placeholder="Phone" required maxlength="20">
                            </div>
                            <div class="col-md">
                                <input value="{{ old('job') }}" class="form-control @error('job') is-invalid @enderror" type="text" name="job" placeholder="Job Tittle" required maxlength="1000">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <input value="{{ old('subject') }}" class="form-control @error('subject') is-invalid @enderror" type="text" name="subject" placeholder="Subject" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea value="{{ old('message') }}" class="form-control @error('message') is-invalid @enderror" name="message"class="form-control" placeholder="Message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>