import { shallowMount } from '@vue/test-utils'
import CardBox from '../CardBox'

describe('Card box component', () => {
  it('is passing the content into the card.', () => {
    const wrapper = shallowMount(CardBox, {
      slots: {
        default: 'foo'
      }
    })

    expect(wrapper.find('#card-body').text()).toBe('foo')
  })
})
