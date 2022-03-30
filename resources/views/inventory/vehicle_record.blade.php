
    @include('inventory.vehicle_record_head_page')
    <div class="bg-white" style="background-color: #fff">
        <img class="stnd skip-lazy " width="207" height="110" alt="CTC Auto Group" src="https://149646797.v2.pressablecdn.com/wp-content/uploads/2021/05/brand-logo.png"/>
    </div>
    <div id="ajax-content-wrap">
        @include('inventory.vehicle_record_data_images')

        @include('inventory.vehicle_record_details')

        @include('inventory.vehicle_record_footer')

    </div>
</body>
<script src="https://api.dealermade-next.com/v4/system-services/dm-next-hd-viewer-loader" async=""></script>
</html>
