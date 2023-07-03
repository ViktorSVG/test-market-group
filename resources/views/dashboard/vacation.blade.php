@foreach($vacations as $vocation)
    @if (!$vocation)
        @continue
    @endif
    @php
        $vocation = explode('>', $vocation);
        $row = array_combine(['id', 'from', 'to', 'approve'], $vocation);
    @endphp
    @if($approve)
        @if($row['approve'])
            <div
                class="vacation text-bg-success rounded-1 d-inline-block px-3"
                style="cursor: default"
                data-id="{{$row['id']}}"
            >
                c {{ $row['from'] }} по {{ $row['to'] }}
                <img action="unapproved" title="Рассогласовать" class="d-inline-block " style="vertical-align: text-bottom; cursor: pointer; margin-left: 0.5rem" src="/icons/reply.svg" width="18" height="18" />
            </div>
        @elseif($editable)
            <div
                class="vacation bg-secondary-subtle border border-black rounded-1 d-inline-block px-3"
                style="cursor: default"
                data-id="{{$row['id']}}"
                data-date-from="{{$row['from']}}"
                data-date-to="{{$row['to']}}"
            >
                c {{ $row['from'] }} по {{ $row['to'] }}
                <img action="edit" title="Редактировать" class="d-inline-block " style="vertical-align: text-bottom; cursor: pointer; margin-left: 0.5rem" src="/icons/pencil-square.svg" width="18" height="18" />
                <img action="drop" title="Отменить отпуск" class="d-inline-block " style="vertical-align: text-bottom; cursor: pointer; margin-left: 0.5rem" src="/icons/trash.svg" width="18" height="18" />
                <img action="approve" title="Согласовать" class="d-inline-block " style="vertical-align: text-bottom; cursor: pointer; margin-left: 0.5rem" src="/icons/check-square.svg" width="18" height="18" />
            </div>
        @else
            <div class="vacation bg-secondary-subtle border border-black rounded-1 d-inline-block px-3" style="cursor: default" data-id="{{$row['id']}}" data-date-from="{{$row['from']}}" data-date-to="{{$row['to']}}">
                c {{ $row['from'] }} по {{ $row['to'] }}
                <img action="approve" title="Согласовать" class="d-inline-block " style="vertical-align: text-bottom; cursor: pointer; margin-left: 0.5rem" src="/icons/check-square.svg" width="18" height="18" />
            </div>
        @endif
    @else
        @if($row['approve'])
            <div class="text-bg-success rounded-1 d-inline-block px-3" style="cursor: default">
                c {{ $row['from'] }} по {{ $row['to'] }}
            </div>
        @elseif($editable)
            <div class="vacation bg-secondary-subtle border border-black rounded-1 d-inline-block px-3" style="cursor: default" data-id="{{$row['id']}}" data-date-from="{{$row['from']}}" data-date-to="{{$row['to']}}">
                c {{ $row['from'] }} по {{ $row['to'] }}
                <img action="edit" title="Редактировать" class="d-inline-block " style="vertical-align: text-bottom; cursor: pointer; margin-left: 0.5rem" src="/icons/pencil-square.svg" width="18" height="18" />
                <img action="drop" title="Отменить отпуск" class="d-inline-block " style="vertical-align: text-bottom; cursor: pointer; margin-left: 0.5rem" src="/icons/trash.svg" width="18" height="18" />
            </div>
        @else
            <div class="bg-secondary-subtle border border-black rounded-1 d-inline-block px-3" style="cursor: default">
                c {{ $row['from'] }} по {{ $row['to'] }}
            </div>
        @endif
    @endif
@endforeach
