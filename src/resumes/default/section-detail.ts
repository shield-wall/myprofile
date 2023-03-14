import {ResumeInterface} from "../../models/resume";

export default function sectionDetail(resume: ResumeInterface) {
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
                ${resume.basic.about}
            </div>
        </section>

        {# experience #}
        {% if experiences | length > 0 %}
            <section class="mt-4">
                {% include '@Curriculum/cv01/components/title.html.twig' with {
                    icon: 'fa fa-briefcase',
                    title: 'curriculum.experiences' | trans,
                } %}

                {% for experience in experiences %}
                    {% include '@Curriculum/cv01/components/box_detail.html.twig' with {
                        title: experience.title,
                        entity: experience.company,
                        dateStarted: experience.dateStarted,
                        dateFinished: experience.dateFinished,
                        description: experience.description,
                    } %}
                {% endfor %}
            </section>
        {% endif %}

        {# Education #}
        {% if educations | length > 0 and  experiences | length < 3 %}
            <section class="mt-4">
                {% include '@Curriculum/cv01/components/title.html.twig' with {
                    icon: 'fas fa-graduation-cap',
                    title: 'curriculum.education' | trans,
                } %}

                {% for education in educations %}
                    {% include '@Curriculum/cv01/components/box_detail.html.twig' with {
                        title: education.title,
                        entity: education.institution,
                        dateStarted: education.dateStarted,
                        dateFinished: education.dateFinished,
                        description: education.description,
                    } %}
                {% endfor %}
            </section>
        {% endif %}
    </div>

    {# certifications #}
    {% if certifications | length > 0 %}
        <section class="mt-4">
            <h4>
                <span class="icon-text">
                    <span class="icon">
                        <i class="fa fa-certificate"></i>
                    </span>
                    <span>{{ 'curriculum.certifications' | trans }}</span>
                </span>
            </h4>

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
    {% endif %}

</div>
    `;
}