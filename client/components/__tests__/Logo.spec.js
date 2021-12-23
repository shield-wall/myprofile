import { RouterLinkStub, shallowMount } from '@vue/test-utils'
import Logo from '../Logo'

function factory () {
  return shallowMount(Logo, {
    stubs: {
      NuxtLink: RouterLinkStub
    },
    mocks: {
      localePath: i => i
    }
  })
}

describe('Logo', () => {
  test('mounts properly', () => {
    const wrapper = factory()
    expect(wrapper.find('div')).toBeTruthy()
  })

  test('renders properly', () => {
    const wrapper = factory()
    expect(wrapper.html()).toMatchSnapshot()
  })
})
