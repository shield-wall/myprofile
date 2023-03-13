import {ResumeTemplateInterface} from "../contracts/resume-template";
import {User} from "../../contracts/user";

export default class defaultTemplate implements ResumeTemplateInterface {
    constructor(private user: User) {
        this.user = user;
    }

    template(): string {
        return `
            <main className="hello">
                <h1>
                    Hello Resume! ${this.user.firstName}
                </h1>
            </main>
    `
    }
};