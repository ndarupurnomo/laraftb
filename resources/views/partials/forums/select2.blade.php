<!-- select2 -->
<script type="text/javascript" src="/bower_components/select2/dist/js/select2.min.js"></script>
<!-- initialize select2 -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#cat_id').select2({
            placeholder: "Pick a category...",
            allowClear: true
        });
    });
</script>