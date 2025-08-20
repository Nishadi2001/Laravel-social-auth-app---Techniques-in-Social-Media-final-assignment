<h1>Welcome, {{ Auth::user()->name }}</h1>
<p>Email: {{ Auth::user()->email }}</p>
<img src="{{ Auth::user()->avatar }}" width="100">
