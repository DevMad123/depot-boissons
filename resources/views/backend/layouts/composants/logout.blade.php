
{{-- {{ Auth::guard('admin')->user()->name }} --}}
<a class="dropdown-item" href="{{ route('admin.logout.submit') }}"
    onclick="event.preventDefault();
              document.getElementById('admin-logout-form').submit();">Logout</a>

<form id="admin-logout-form" action="{{ route('admin.logout.submit') }}" method="POST" style="display: none;">
    @csrf
</form>
