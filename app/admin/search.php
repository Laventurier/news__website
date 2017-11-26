<div class="search-page">
    <div class="container">
       <h1 class="page-name">Search Posts</h1>
        <div class="line-form-search">
            <form action="ajaxsearch.php" id='ajaxsearch'>
                <input type="search" placeholder="Search...">
                <button type="submit">search</button>
            </form>
            <div class="search-result"></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#ajaxsearch').submit(function(event) {
            event.preventDefault();
            var action = this.action;
            $.ajax({
                url: action,
                method: 'post',
                data: {
                    'search': $('#ajaxsearch').find('input[type="search"]').val()
                },
                dataType: 'html',
                success: function(response) {
                    $('.search-result').html(response);
                },
                error: function() {
                    alert('There was an error, while sending Ajax!');
                }
            });
        });
    });

</script>
