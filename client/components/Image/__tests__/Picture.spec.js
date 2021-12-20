import { shallowMount } from '@vue/test-utils'
import Picture from '../Picture'

function factory () {
  return shallowMount(Picture, {
    propsData: {
      path: '/foo.webp',
      alt: 'foo alt text.'
    }
  })
}

describe('Picture component.', function () {
  it('is getting the correct image HTML.', () => {
    const wrapper = factory()
    expect(wrapper.html()).toMatchSnapshot()
  })
})
