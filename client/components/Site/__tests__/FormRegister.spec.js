import { shallowMount, RouterLinkStub } from '@vue/test-utils'
import FormRegister from '../FormRegister'

function factory () {
  return shallowMount(FormRegister, {
    stubs: {
      NuxtLink: RouterLinkStub
    }
  })
}

describe('Form register component', () => {
  it('has all fields necessary to register new user.', () => {
    const wrapper = factory()

    expect(wrapper.find('#first-name').exists()).toBeTruthy()
    expect(wrapper.find('#last-name').exists()).toBeTruthy()
    expect(wrapper.find('#email').exists()).toBeTruthy()
    expect(wrapper.find('#password').exists()).toBeTruthy()
    expect(wrapper.find('#repeat-password').exists()).toBeTruthy()
    expect(wrapper.find('#register-button').exists()).toBeTruthy()
  })

  it('has a link to go to login page.', () => {
    const wrapper = factory()

    expect(wrapper.find('#ask-for-login').html()).toMatchSnapshot()
  })
})
