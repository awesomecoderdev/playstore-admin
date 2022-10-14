import React, { useState } from 'react'
import { Switch } from '@headlessui/react'

const Product = () => {
    const [enabled, setEnabled] = useState(awesomecoderLicenceProduct)

    return (
      <div className='relative w-full h-full min-h-[2.5rem] bg-gray-100 rounded-md px-3 flex items-center'>
        <input type="hidden" name="awesomecoderLicenceProduct" value={enabled} />
        <Switch
          checked={enabled}
          onChange={setEnabled}
          className={`${
            enabled ? 'bg-primary-400' : 'bg-gray-200'
          } relative inline-flex h-6 w-11 items-center rounded-full p-0`}
        >
          <span
            className={`${
              enabled ? 'translate-x-6' : 'translate-x-1'
            } inline-block h-4 w-4 transform rounded-full bg-white transition`}
          />
        </Switch>
        <span className="text-slate-600 font-semibold text-xs ml-2">Enable Licence Product</span>
      </div>
    )
}

export default Product;
