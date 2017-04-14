@if (! $errors->isEmpty())
  <div class="alert alert-danger">
  <p><strong>Caramba!</strong> Arregla los siguiente errores:</p><br>
  <ul>
      @foreach ($errors->all() as $error)

          <li>{{$error}}</li>

      @endforeach
  </ul>
  </div>

@endif
