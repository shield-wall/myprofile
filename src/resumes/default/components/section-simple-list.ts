import {Icons} from "../../../components/icons";
import {SimpleList} from "../../../models/simple-list";

export function sectionSimpleList(simpleList: SimpleList): string {

    // @ts-ignore
    let _icon = Icons[simpleList.getIcon()];

    return ` <div class="icon-text">
                      <span class="icon">${_icon}</span>
                      <span>${simpleList.getTitle()}</span>
                </div>`;
}