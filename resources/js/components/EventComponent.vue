<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between">
                        <h6 class="my-auto">Event List</h6>
                        <button type="button" @click="$router.push({name: 'AddEvent'})"
                                class="btn btn-primary rounded-0 text-center pe-4 ps-4 float-end me-3">
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
                                    <th scope="col">Is Completed</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(event, index) in events.data" :key="index">
                                    <th scope="row">{{ page === 1 ? (index + 1) : ((page - 1) * perPage) + (index + 1) }}</th>
                                    <td>{{ event.title }}</td>
                                    <td>{{ event.formatted_start_date }}</td>
                                    <td>{{ event.formatted_end_date }}</td>
                                    <td>{{ event.is_completed === 1 ? 'Completed' : 'Not Completed' }}</td>
                                    <td>
                                        <button type="button"
                                                @click="$router.push({name: 'EditEvent', params: {'id': event.id}})"
                                                class="btn btn-primary rounded-0 text-center">
                                            Edit Event
                                        </button>
                                        <button type="button"
                                                @click="deleteEvent(event.id)"
                                                class="btn btn-danger rounded-0 text-center ms-2">
                                            Delete Event
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <Bootstrap5Pagination :data="events" :limit="2"
                                                  @pagination-change-page="getEvents"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {axiosInstance} from "../Api";
import {Bootstrap5Pagination} from "laravel-vue-pagination";

export default {
    data() {
        return {
            title: 'Add New Event',
            events: {},
            page: null,
            perPage: null,
        }
    },

    components: {
      Bootstrap5Pagination
    },

    mounted() {
        this.getEvents(1);
    },

    methods: {
        async getEvents(page) {
            this.showLoader();
            this.page = page;
            try {
                axiosInstance.get('event?page='+page)
                    .then(res => {
                        this.events = res.data;
                        this.perPage = res.data.meta.per_page
                    })
            } catch (err) {
                this.hideLoader();
                console.log({'errors': err})
            }
        },

        deleteEvent(id) {
            if (confirm("Do you want to delete the event?")) {
                this.showLoader();
                axiosInstance.delete(`event/${id}`)
                    .then(res => {
                        if (res.data.success === true) {
                            this.getEvents(1);
                            toastr.success(res.data.message)
                        }
                    }).catch(err => {
                    this.hideLoader();
                    console.log(err);
                });
                this.hideLoader();
            }
        }
    }
}
</script>
