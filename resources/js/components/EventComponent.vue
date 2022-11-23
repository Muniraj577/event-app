<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between">
                        <h6 class="my-auto">Event List</h6>
                        <button type="submit" class="btn btn-primary rounded-0 text-center pe-4 ps-4 float-end me-3"
                                data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            New Event
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-primary table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">S.N</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--        Begin Event Modal-->
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <form>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ title }} </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">{{ this.formData.id ? 'Update' : 'Save' }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import {axiosInstance} from "../Api";

export default {
    data() {
        return {
            title: 'Add New Event',
            formData: {},
        }
    },

    mounted() {
        if (this.formData.id) {
            this.title = 'Edit Event'
        }
    }
}
</script>
