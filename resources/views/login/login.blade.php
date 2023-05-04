<div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="loginmodalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header color-theme-1">
                        <h3 class="modal-title text-white" id="exampleModalLongTitle">Login</h3>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="newsletter-email" class="content-hidden">E-Mail / Username</label>
                                <input type="email" name="email" id="newsletter-email"
                                    class="form-control form-control-lg" placeholder="E-Mail / Username"
                                    autocomplete="off">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="content-hidden">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control form-control-lg" placeholder="Password" autocomplete="off">
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>