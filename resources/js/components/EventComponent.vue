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
                            <div class="row">
                                <div class="col-md-4">
                                    <select class="form-select" v-model="eventStatus" @change="getEvents(1)">
                                        <option value="">Select Option</option>
                                        <option v-for="(status, i) in event_status" :key="i" :value="status.value">
                                            {{ status.label }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary btn-outline-light bg-primary text-white" @click="clearFilter">
                                        <i class="bi bi-funnel"></i>
                                    </button>
                                </div>
                            </div>
                            <table class="table table-primary table-striped mt-5">
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
                                    <th scope="row">{{
                                            page === 1 ? (index + 1) : ((page - 1) * perPage) + (index + 1)
                                        }}
                                    </th>
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
                            <Bootstrap5Pagination :data="events" :limit="2" align="right"
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
import {EVENT_STATUS} from "../constants/appConstants";

export default {
    data() {
        return {
            title: 'Add New Event',
            events: [],
            page: null,
            perPage: null,
            event_status: EVENT_STATUS,
            eventStatus: '',
            url: 'event?',
        }
    },

    components: {
        Bootstrap5Pagination
    },

    mounted() {
        this.getEvents(1, this.url);
    },

    methods: {
        async getEvents(page, url) {
            console.log(this.eventStatus)
            this.showLoader();
            this.page = page;
            if (url == null && this.eventStatus == ''){
                url = 'event?page='+page;
            } else if (this.eventStatus != ''){
                url = 'event?page='+page+'&event_status='+this.eventStatus;
            }
            try {
                axiosInstance.get(url)
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
        },

        clearFilter(){
            this.eventStatus = '';
            this.getEvents(1);
        }
    },

    // watch:{
    //     eventStatus(val){
    //         this.getEvents(1, `${this.url}page=${this.page}&event_status=${val}`);
    //     },
    //     'page': function (){
    //         if (this.eventStatus){
    //             this.getEvents(1, `${this.url}page=${this.page}&event_status=${this.eventStatus}`);
    //         }
    //     }
    // }
}
</script>
