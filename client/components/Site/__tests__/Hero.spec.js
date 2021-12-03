import { shallowMount } from '@vue/test-utils'
import Hero from '../Hero'

describe('Hero component', () => {
  it('form register into the component.', () => {
    const wrapper = shallowMount(Hero, {
      mocks: {
        $t: key => key
      }
    })

    expect(wrapper.find('#form-register').exists()).toBeTruthy()
  })
})
