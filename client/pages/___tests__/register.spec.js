import { shallowMount, RouterLinkStub } from '@vue/test-utils'
import Register from '../register'

function factory () {
  return shallowMount(Register, {
    stubs: {
      NuxtLink: RouterLinkStub
    }
  })
}

describe('Register page.', () => {
  it('has form register and login component.', () => {
    const wrapper = factory()

    expect(wrapper.find('#form-register').exists()).toBeTruthy()
    expect(wrapper.find('#logo').exists()).toBeTruthy()
  })
})
