import { Icons } from "../../../components/icons";
import { OptionalTitleInterface } from "../../../models/contracts/title-interface";
import { OptionalIconInterface } from "../../../models/contracts/icon-interface";

export default function title(
	object: OptionalTitleInterface & OptionalIconInterface
): string {
	if (object.getTitle() === null || object.getIcon() === null) return "";

	// @ts-ignore
	const _icon = Icons[object.getIcon()];
	return `
            <div class="is-size-5 has-text-weight-bold">
                <span class="icon-text">
                    <span class="icon">${_icon}</span>
                    <span>${object.getTitle()}</span>
                </span>
            </div>
    `;
}
