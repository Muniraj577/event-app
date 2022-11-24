import EventComponent from "./components/EventComponent.vue";
import AddEventComponent from "./components/AddEventComponent.vue";


export const routes = [
    {
        name: 'Event',
        path: '/',
        component: EventComponent,
        meta: {title: 'Event List'}
    },
    {
        name: 'AddEvent',
        path: '/add/event',
        component: AddEventComponent,
        meta: {title: 'Add Event'}
    }
]
