import { Certification } from "../../../models/certification";
import { PhotoUrlInterface } from "../../../models/contracts/photo-url-interface";
import { Icons } from "../../../components/icons";

export default function sectionCertification(
	certification: Certification
): string {
	const logo = (object: PhotoUrlInterface) => {
		if (object.getPhotoUrl() === null)
			return `
                 <div class="media-left">${Icons["certification"]}</div>
            `;

		return `
              <figure class="media-left">
                <p class="image is-48x48">
                    <img src="${object.getPhotoUrl()}" alt="logo certification">
                </p>
            </figure>
        `;
	};

	return `
        <div class="column py-0 pb-1">
                    <article class="media">
                        ${logo(certification)}
                        <div class="media-content">
                            <div class="content is-small">
                                <div class="has-text-weight-bold">${certification.getTitle()}</div>
                                <div>${certification.getTimePeriod()}</div>
                            </div>
                        </div>
                    </article>
                </div>
        `;
}
