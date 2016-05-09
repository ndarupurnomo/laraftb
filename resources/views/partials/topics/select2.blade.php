<!-- select2 -->
<script type="text/javascript" src="/bower_components/select2/dist/js/select2.min.js"></script>
<!-- initialize select2 -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#license_id').select2({
            placeholder: "Pick a license...",
            allowClear: true
        });
        $('#publisher_id').select2({
            placeholder: "Pick a publisher...",
            allowClear: true
        });
        $('#forumIds').select2({
            placeholder: "Pick one or more sub-categories..."
        });
        $('#authorIds').select2({
            placeholder: "Pick one or more authors..."
        });
    });
</script>