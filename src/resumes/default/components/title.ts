import {TitleInterface} from "../../../models/title-interface";

export default function title(object: TitleInterface): string
{
    return `
                <h4>
                    <span class="icon-text">
                        <span class="icon">
                            <i class="fa fa-briefcase"></i>
                        </span>
                        <span>${object.getTitle()}</span>
                    </span>
                </h4>
    `;
}