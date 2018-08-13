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
    <label for="name">{{ __("laravel-blog::user.form.name") }}</label>
    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required>
  </div>

  <div>
    <label for="email">{{ __("laravel-blog::user.form.email") }}</label>
    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
  </div>

  <div>
    <label for="email">{{ __("laravel-blog::user.form.lang") }}</label>
    <select name="lang">
        @foreach (config()->get("blog.locales") as $code)
          <option value="{{ $code }}" @if(old('lang', $user->lang) == $code) selected @endif>{{ __("laravel-blog::language.$code") }}</option>
        @endforeach
    </select>
  </div>

  <div>
    <label for="picture">{{ __("laravel-blog::user.form.picture") }}</label>
    <div class="colibri" id="colibri" data-pic="{{ $user->pictureUrl }}" data-post="{{ route('admin.blog.image.upload')."?fieldName=picture&maxWidth=500&maxHeight=500&_token=".csrf_token() }}">
        <label for="file">
            <div>{{ __("laravel-blog::user.form.choose") }}</div>
        </label>
        <input type="file" id="file" data-message="{{ __("laravel-blog::user.form.uploading") }}">
    </div>
    <input type="hidden" name="picture" data-js="picture" value="">
  </div>

  <div>
    <label for="biography">{{ __("laravel-blog::user.form.biography") }}</label>
    <textarea id="biography" type="text" name="biography">
      {{ old('biography', $user->biography) }}
    </textarea>
  </div>

  <div>
    <label>Divers</label>
    <input type="checkbox" name="isAdmin" id="isAdmin" class="switch" @if(old('isAdmin', $user->isAdmin)) checked @endif>
    <label for="isAdmin">Administrateur</label>
  </div>
