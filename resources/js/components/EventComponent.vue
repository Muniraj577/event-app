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
                                <tr v-for="(event, index) in events" :key="index">
                                    <th scope="row">{{ index + 1 }}</th>
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
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
            events: [],
        }
    },

    mounted() {
        this.getEvents();
    },

    methods: {
        getEvents() {
            try {
                axiosInstance.get('event')
                    .then(res => {
                        this.events = res.data;
                        console.log(this)
                    })
            } catch (err) {
                console.log({'errors': err})
            }
        }
    }
}
</script>
