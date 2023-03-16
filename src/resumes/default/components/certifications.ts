import {Certification} from "../../../models/certification";
import {Section} from "../../../models/section";
import title from "./title";
import {PhotoUrlInterface} from "../../../models/photo-url-interface";

export default function certifications(certifications: Certification[]): string|null {

    if(certifications.length === 0)
        return null;

    let logo = (object: PhotoUrlInterface) => {
        if(object.getPhotoUrl() === null)
            return `
                 <div class="media-left">
                    <i class="fa fa-certificate fa-4x"></i>
                </div>
            `

        return `
              <figure class="media-left">
                <p class="image is-48x48">
                    <img src="${object.getPhotoUrl()}" alt="logo certification">
                </p>
            </figure>
        `
    };

    let content = '';
    certifications.forEach((certification) => {
        content += `
        <div class="column is-half">
                    <article class="media">
                        ${logo(certification)}

                        <div class="media-content">
                            <div class="content is-small">
                                <h4>${certification.getTitle()}</h4>
                                <div>${certification.getTimePeriod()}</div>
                            </div>
                        </div>
                    </article>
                </div>
        `
    });

    return `
        ${title(new Section('Certifications'))}

        <div class="columns is-gapless is-multiline">
            ${content}
        </div>
    `;
}