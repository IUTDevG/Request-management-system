<form method="POST" action="{{ route('social.complete') }}">
    @csrf
    <div>
        <label for="username">Nom d'utilisateur</label>
        <input id="username" type="text" name="username" required autofocus>
        @error('username')
        <span>{{ $message }}</span>
        @enderror
    </div>
    <button type="submit">Finaliser l'inscription</button>
</form>
