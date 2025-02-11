<x-backend :backend="false" title="inscription citoyen">
    <div class="page-wrapper" style="overflow: scroll">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="/">
                                <img src="{{ asset('images/logo.webp') }}" alt="Panne office"
                    style="width: 80px;height: 75px;border-radius: 50%">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="{{route('register')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input class="au-input au-input--full" type="text" name="nom" placeholder="nom" value="{{old('nom')}}">
                                    @error('nom')
                                        <label  class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input class="au-input au-input--full" type="text" name="prenom" placeholder="prenom" value="{{old('prenom')}}">
                                    @error('prenom')
                                        <label  class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input class="au-input au-input--full" type="text" name="telephone" placeholder="telephone" value="{{old('telephone')}}">
                                    @error('telephone')
                                        <label  class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email" value="{{old('email')}}">
                                    @error('email')
                                        <label  class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="mot de passe">
                                    @error('password')
                                        <label  class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input class="au-input au-input--full" type="password" name="password_confirmation" placeholder="confirmation de mot de passe">
                                    @error('password_confirmation')
                                        <label  class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">S'inscrire</button>
                                
                            </form>
                            <div class="register-link">
                                <p>
                                    Vous avez un compte?
                                    <a href="{{route('login')}}">Se connecter</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-backend>