<x-backend :backend="false" title="login">
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
                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                @error('email')
                                        <label  class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Mot de passe</label>
                                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                @error('password')
                                        <label  class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="login-checkbox">
                                <label>
                                    <input type="checkbox" name="remember">Se souvenir de moi
                                </label>
                                <label>
                                    <a href="{{ route('password.request')}}" class="text-primary">Mot de passe oublie?</a>
                                </label>
                            </div>
                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">se connecter</button>
                            
                        </form>
                        <div class="register-link">
                            <p>
                                Etes vous nouveau?
                                <a href="{{route('register')}}" class="text-primary">s'inscrire</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-backend>