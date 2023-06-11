import { Promiseify } from "./helper";

export class State {}
export class Action {}
export default class Context {
    private static instance = new Map();

    state = new State();
    action = new Action();
    event = new EventTarget();
    media_query: {
        sm: MediaQueryList;
    } = { sm: null };
    private state_init = new Promiseify();

    constructor(private key: string = "_") {}
    static get_or_create(key: string): Context {
        let instance = this.instance.get(key);
        if (!instance) {
            instance = this.create(key);
        }
        return instance;
    }
    static get(key: string): Context | undefined {
        let instance = this.instance.get(key);
        return instance;
    }
    static create(key: string): Context {
        const instance = new Context(key);
        this.instance.set(key, instance);
        return instance;
    }

    init() {
        this.load();
        this.media_query.sm = matchMedia("(max-width: 640px)");
        this.state_init.resolver();
    }
    inited() {
        return this.state_init;
    }
    update(state: State, save = true) {
        this.state = { ...this.state, ...state };
        save && this.save();
    }
    set_state(key: string, value: object) {
        this.state[key] =  value;
    }
    sync_state(key: string, value: object, update?: (value: object) => void) {
        if (key in this.state) {
            update?.(this.state[key]);
        } else {
            this.state[key] =  value;
        }
    }
    load() {
        const raw = localStorage.getItem(this.key);
        if (!raw) return;
        this.state = JSON.parse(raw);
    }
    save() {
        localStorage.setItem(this.key, JSON.stringify(this.state));
    }
}
