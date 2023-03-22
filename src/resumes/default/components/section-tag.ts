import { Tag } from "../../../models/tag";

export function sectionTag(tag: Tag): string {
	const _tag = tag.getTag();

	if (Array.isArray(_tag)) {
		return `
            <div class="my-2">
                <div class="tags has-addons">
                    <span class="tag">${_tag[0]}</span>
                    <span class="tag is-black">${_tag[1]}</span>
                </div>
            </div>
            `;
	}

	return `<div class="tag is-dark">${_tag}</div>`;
}
