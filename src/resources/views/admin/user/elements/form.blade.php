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
    <div class="colibri" id="colibri" data-pic="{{ $user->pictureUrl }}" data-post="{{ route('admin.blog.image.upload')."?fieldName=picture&_token=".csrf_token() }}">
        <label for="file">
            <div>Choose a picture</div>
        </label>
        <input type="file" id="file" data-message="Upload in progress...">
    </div>
    <input type="hidden" name="picture" data-js="picture" value="">
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
