<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between">
                        <h6 class="my-auto">Add Event</h6>
                        <button type="button" @click="$router.push({name: 'Event'})"
                                class="btn btn-primary rounded-0 text-center pe-4 ps-4 float-end me-3">
                            Event List
                        </button>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {}
    }
}
</script>
