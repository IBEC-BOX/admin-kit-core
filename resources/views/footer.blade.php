@guest
    <p>Admin Kit. {{date('Y')}}</p>
@else

    <div class="text-center user-select-none">
        <p class="small m-0">
            <a href="https://github.com/admin-kit" target="_blank" rel="noopener">
                {{date('Y')}}. Admin Kit Core: v{{\AdminKit\Core\Core::VERSION}}
            </a>
        </p>
    </div>
@endguest
