<div class="container border rounded" style="border-radius:30px; background: #535353; padding:10px; width: 70%;">
    <table style="color: white; width: 100%; table-layout: fixed; margin: auto;">
        <thead>
            <tr>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php
                $itemsCount = count($mes);
                $itemsPerColumn = ceil($itemsCount / 2);
            @endphp
            @for ($i = 0; $i < $itemsPerColumn; $i++)
                <tr style="display: flex; flex-wrap: wrap; justify-content: space-between;">
                    @for ($j = 0; $j < 2; $j++)
                        @php
                            $index = $i + ($j * $itemsPerColumn);
                            if ($index < $itemsCount) {
                                $item = $mes[$index];
                            }
                        @endphp
                        @if (isset($item))
                            <td style="border: 1px solid white; border-radius: 10px; text-align:center; font-size: 16px; width: calc(50% - 20px); margin: 10px; padding: 15px;">
                                <img src="https://kasta.ua/image/1035/s3/6/66/1a6/11146662/32783843/32783843_original.jpeg" alt="Product Image" style="width: 100%; margin: 10px; border-radius: 10px;">
                                <div>{{$item->title}}</div>
                                <div>{{$item->price}} $</div>
                                <div style="margin-top: 20px;">
                                    <a href="http://exam-work/catalog/readMore/{{$item->id}}" style="
                                        color: black;
                                        padding: 15px 25px;
                                        text-decoration: none;
                                        background: white;
                                        border-radius: 15px;
                                        display: block;
                                    "><b>Check</b></a>
                                </div>
                            </td>
                        @endif
                    @endfor
                </tr>
            @endfor
        </tbody>
    </table>
</div>