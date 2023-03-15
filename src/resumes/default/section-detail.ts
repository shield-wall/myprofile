import title from "./components/title";
import {Section} from "../../models/section";
import boxDetail from "./components/box-detail";
import {Resume} from "../../models/resume";

export default function sectionDetail(resume: Resume) {
    return `
    <div class="content is-normal">

    <div class="has-text-justified">

        <section class="mt-4">
            <h4>
                <span class="icon-text">
                    <span class="icon">
                        <i class="fa fa-user"></i>
                    </span>
                    <span>About</span>
                </span>
            </h4>
            <div>
                ${resume.getBasic().getAbout()}
            </div>
        </section>

            <section class="mt-4">
                ${title(new Section('Experience'))}
                ${resume.getExperiences().map((experience) => boxDetail(experience))}
            </section>
            
           <section class="mt-4">
                ${title(new Section('Educations'))}
                ${resume.getEducations().map((education) => boxDetail(education))}
            </section>
    </div>

    <section class="mt-4">
        ${title(new Section('Certifications'))}

        <div class="columns is-gapless is-multiline">
            {% for certification in certifications %}
                <div class="column is-half">
                    <article class="media">
                            {% if certification.logo %}
                                <figure class="media-left">
                                    <p class="image is-48x48">
                                        <img src="{{ certification.logo }}" alt="logo certification">
                                    </p>
                                </figure>
                            {% else %}
                                <div class="media-left">
                                    <i class="fa fa-certificate fa-4x"></i>
                                </div>
                            {% endif %}

                        <div class="media-content">
                            <div class="content is-small">
                                <h4>{{ certification.title }}</h4>
                                <div>
                                    {{ certification.dateStarted | date('M Y') }} -
                                    {% if certification.dateFinished %}
                                        {{ certification.dateFinished | date('M Y') }}
                                    {% else %}
                                        present
                                    {% endif %}
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            {% endfor %}
        </div>
    </section>

</div>
    `;
}