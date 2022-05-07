<script>
    $(document).ready(function() {

        $('.push').click (function () {
            var post_id = $(this).attr("id");
            window.history.pushState('post', 'Title', "<?= env('APP_URL').'/post/' ?>" + post_id );

            $.ajax({
                url: "<?= route('.') ?>" + "/get-post-content/" + post_id,
                method: "GET",
                dataType: "JSON",
                data: {
                    'post_id': post_id
                },
                success: function (response) {
                    if (response.status == 'ok') {
                        let comments = response.comments;
                        $('div.modal-body').empty();
                        comments.forEach((comment) => {
                            $('div.modal-body').append(
                                '<div class="d-flex">'
                                + '<div class="icon"> <i class="bx bxl-mailchimp"></i> </div>' +
                                '<h5><strong>'+ comment.name +':</strong></h5>&nbsp'
                                + comment.body + '<br>' +
                                '</div>');
                        });
                    }
                },
            });
        });

        $('.btn-close').click(function () {
            window.history.pushState('home', 'Title',"<?= route('.' ) ?>" );
            $('div.modal-body').empty();
        });

        $('.modal').on('hidden.bs.modal', function () {
            window.history.pushState('home', 'Title', "<?= route('.' ) ?>" );

        });
    });
</script>
