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
                        <form @submit.prevent="addEvent" ref="eventForm">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="eventTitle" class="form-label">Event Title *</label>
                                    <input type="text" class="form-control" id="eventTitle" placeholder="Event Title *"
                                           v-model="formData.title" required>
                                    <span class="text-danger" v-if="errors.title">
                                        {{errors.title[0]}}
                                    </span>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="startDate" class="form-label">Start Date *</label>
                                    <input type="datetime-local" class="form-control" id="startDate"
                                           v-model="formData.start_date" required>
                                    <span class="text-danger" v-if="errors.start_date">
                                        {{errors.start_date[0]}}
                                    </span>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="endDate" class="form-label">End Date *</label>
                                    <input type="datetime-local" class="form-control" id="endDate"
                                           v-model="formData.end_date" required>
                                    <span class="text-danger" v-if="errors.end_date">
                                        {{errors.end_date[0]}}
                                    </span>
                                </div>
                                <div class="col-md-12  mt-2">
                                    <label for="description">Description *</label>
                                    <textarea class="form-control"
                                              id="description" rows="3" required
                                              v-model="formData.description"></textarea>
                                    <span class="text-danger" v-if="errors.description">
                                        {{errors.description[0]}}
                                    </span>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Save
                                    </button>
                                </div>
                            </div>
                        </form>
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
            formData: {},
            errors: [],
        }
    },

    mounted() {
        this.showLoader();
    },

    methods: {
        async addEvent() {
            this.showLoader();
            await axiosInstance.post('event', this.formData)
                .then(res => {
                    if (res.data.success === true){
                        this.$router.push({'name': 'Event'});
                    }
                }).catch(err => {
                    this.hideLoader()
                    this.errors = err.response.data.errors;
                })
        }
    }
}
</script>
