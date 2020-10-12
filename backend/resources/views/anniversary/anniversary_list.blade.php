<ul class="list-group">
    @foreach($anniversaries as $anniversary)
        <li class="list-group-item">
            <div class="my-1">
                <a href="/anniversary/{{ $anniversary->id }}">{{ $anniversary->title }}</a>
                <span class="float-right">{{ $anniversary->date->format('Y年m月d日') }}（{{ $anniversary->showRemindTimeForAnniversary() }}）</span>
            </div>
        </li>
    @endforeach
</ul>
