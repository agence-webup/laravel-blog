@if($errors->any())
  <div>
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

  <div>
    <label for="name">Name</label>
    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required>
  </div>

  <div>
    <label for="email">Email address</label>
    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
  </div>

  <div>
    <label for="picture">Profil picture</label>
    <div class="colibri" id="picture" data-pic="" data-post="{{ route('admin.blog.image.upload')."?fieldName=picture&_token=".csrf_token() }}">
        <label for="file">
            <div>Choisir une image</div>
        </label>
        <input type="file" name="picture" id="file" data-message="Téléchargement en cours...">
    </div>
  </div>

  <div>
    <label for="biography">Biography</label>
    <textarea id="biography" type="text" name="biography">
      {{ old('biography', $user->biography) }}
    </textarea>
  </div>

  <div>
    <label for="isAdmin">isAdmin</label>
    <input id="isAdmin" type="text" name="isAdmin" value="{{ old('isAdmin', $user->isAdmin) }}">
  </div>
