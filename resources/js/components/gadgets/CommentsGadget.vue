<template>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-info">
            <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Bookmarks</span>
                <span class="info-box-number">41,410</span>

                <div class="progress">
                    <div class="progress-bar" :style="'width: ' + percent +'%'"></div>
                </div>
                <span class="progress-description">
                  {{percent+'% Increase in 30 Days'}}
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</template>

<script>
export default {
    name: "comments",
    props: {
        percent: {
            type: Number,
            require: true,
        },
    }

}
</script>

<style scoped>

</style>
