<div class="layout">
    <div class="layout-cell wn-logo-transparent">
        <script>
            $(document).ready(function() {

                var $search = $('#settings-search-input'),
                    focusSearch = function() {
                        setTimeout(function() { $search.focus().select() }, 10)
                    }

                $search.on('blur', focusSearch)
                focusSearch()
            })
        </script>
    </div>
</div>
