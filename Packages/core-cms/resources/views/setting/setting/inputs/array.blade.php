<div class="col-12 p-2">
    <div class="form-group">
        <label class="text-start w-100 d-flex justify-content-start" for="">
            <span>{{@$data['p_name']}}</span>
        </label>
        <input type="text" class="form-control border-0 px-0" name="{{@$data['type']}}[{{@$data['key']}}]" id="{{@$data['key']}}"
               value="{{@$data['value']}}">
    </div>
</div>

@push('scripts')
    <script src="{{asset('assets/admin/js/selectize.js?v0.17')}}"></script>
    <script>
        $( document ).ready(function() {
            $('#{{@$data['key']}}').selectize({
                plugins: ['remove_button'],
                delimiter: ',',
                persist: false,
                valueField: 'tag',
                labelField: 'tag',
                searchField: 'tag',
                create: function(input) {
                    return {
                        tag: input
                    }
                }
            });
        });
        var tags = [

            {tag: "{{@$data['value']}}" },

        ];

    </script>
@endpush
