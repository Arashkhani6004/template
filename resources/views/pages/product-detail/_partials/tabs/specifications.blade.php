<p class="font-bold">
    مشخصات {{@$product['title']}}
</p>
<table class="table">
    <tbody>
    @foreach($specifications as $specification)
        <tr>
            <th style="width: 15rem;" scope="row">{{@$specification[0]->parent->title}}</th>
            <td>
                @foreach($specification as $row)
                    {{$row['title']}} @if(!$loop->last)
                        ,
                    @endif
                @endforeach
            </td>
        </tr>
    @endforeach
    @foreach($specification_values as $specification_value)
        <tr>
            <th style="width: 15rem;" scope="row">{{$specification_value[0]['specification']}}</th>
            <td>
                @foreach($specification_value as $row2)
                    {{$row2['value']}}
                    <br>
                @endforeach
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
