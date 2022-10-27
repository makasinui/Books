import Books from "../components/Books";
import AddBook from "../components/AddBook";
import EditBook from "../components/EditBook";
import Authors from "../components/Authors";
import AddAuthor from "../components/AddAuthor";
import EditAuthor from "../components/EditAuthor";
import Sections from "../components/Sections";
import AddSection from "../components/AddSection";
import EditSection from "../components/EditSection";
import { store } from "../store";
const VueRouter = require("vue-router");

const routes = [
    {
        path: "/",
        name: "Books",
        component: Books,
    },
    {
        path: "/addbook",
        name: "AddBook",
        component: AddBook,
        meta: {
            forUser: true
        }
    },
    {
        path: "/editbook/:bookId/",
        name: "EditBook",
        component: EditBook,
        props: true,
        meta: {
            forAdmin: true
        }
    },
    {
        path: "/authors",
        name: "Authors",
        component: Authors,
    },
    {
        path: "/addauthor",
        name: "AddAuthor",
        component: AddAuthor,
        meta: {
            forAdmin: true
        }
    },
    {
        path: "/editauthor/:authorId/",
        name: "EditAuthor",
        component: EditAuthor,
        props: true,
        meta: {
            forAdmin: true
        }
    },
    {
        path: "/sections",
        name: "Sections",
        component: Sections,
    },
    {
        path: "/editsection/:sectionId/",
        name: "EditSection",
        component: EditSection,
        props: true,
        meta: {
            forAdmin: true
        }
    },
    {
        path: "/addsection",
        name: "AddSection",
        component: AddSection,
        meta: {
            forAdmin: true
        }
    },
];

export const router = VueRouter.createRouter({
    history: VueRouter.createWebHashHistory(),
    routes,
});

router.beforeEach(async (to, from) => {
    await store.dispatch('getUser')
    const current = store.state.user
    
    if (to.meta.forAdmin) {
        if (current.role !== 'admin') {
            return false
        }
    }
    if (to.meta.forUser) {
        if (!current) {
            return false
        }
    }
});
