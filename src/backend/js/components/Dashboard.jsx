import React, { useEffect, Fragment, useState, useRef } from 'react';
import { ClipboardDocumentCheckIcon, ClipboardDocumentIcon, Cog6ToothIcon, KeyIcon, PaintBrushIcon, Squares2X2Icon } from '@heroicons/react/24/outline';
import { Listbox, Transition } from '@headlessui/react'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/react/20/solid'
import { post_types,users, ajaxurl, headers, licenses } from './Backend';
import axios from 'axios';
import Nav from './Nav';

const Dashboard = () => {
    const [enabled, setEnabled] = useState(false);
    const [paged, setPaged] = useState(0);
    const [licensePaged, setLicensePaged] = useState(0);
    const [tab, setTab] = useState(true);

    const getDomain = (href) => {
      if(href){
          const url = href.match(/^(https?\:)\/\/(([^:\/?#]*)(?:\:([0-9]+))?)([\/]{0,1}[^?#]*)(\?[^#]*|)(#.*|)$/);
          return ( url && url[2] && url[2] != null) ? url[2] : false;
      }else{
          return false;
      }
    }

    const copyToClipboard = (e) => {
      const license = e.target.getAttribute("data-license")
      const id = e.target.getAttribute("data-id")
      if((license != null || license != "") && navigator){
        e.target.classList.add("opacity-0")
        document.getElementById(`${id}`).classList.remove("opacity-0")
        navigator.clipboard.writeText(`${license}`)

        setTimeout(() => {
          e.target.classList.remove("opacity-0")
          document.getElementById(`${id}`).classList.add("opacity-0")
        }, 1000);
      }
    };

    return (
        <>
            {/* menu::start */}
            <div className="relative bg-white w-full flex items-center md:justify-between justify-start md:flex-row flex-col px-5 py-3">
                <div className="relative flex w-full md:mb-0 mb-2">
                    <span
                      onClick={(e) => {
                        setTab(true)
                      }}
                      className={`${tab && "opacity-70 pointer-events-none"} mr-2 bg-white cursor-pointer flex items-center p-2 rounded-md border border-slate-400/25 transform translate-y-0 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 shadow-slate-200`}>
                        <Squares2X2Icon className="h-5 pointer-events-none text-slate-500 mr-2"/>SEBT Users
                    </span>
                    {/* <span className='mr-2 bg-white cursor-pointer flex items-center p-2 rounded-md border border-slate-400/25 transform translate-y-0 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 shadow-slate-200 '>
                        <PaintBrushIcon className="h-5 pointer-events-none text-slate-500 mr-2"/>Post Types
                    </span>
                    <span className='mr-2 bg-white cursor-pointer flex items-center p-2 rounded-md border border-slate-400/25 transform translate-y-0 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 shadow-slate-200 '>
                        <Cog6ToothIcon className="h-5 pointer-events-none text-slate-500 mr-2"/>Settings
                    </span> */}
                    <span
                      onClick={(e) => {
                        setTab(false)
                      }}
                      className={`${!tab && "opacity-70 pointer-events-none"} mr-2 bg-white cursor-pointer flex items-center p-2 rounded-md border border-slate-400/25 transform translate-y-0 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 shadow-slate-200`}>
                        <KeyIcon className="h-5 pointer-events-none text-slate-500 mr-2"/>License
                    </span>
                </div>

                <div className={`relative w-72 z-10 ${!tab && "opacity-50 pointer-events-none"}`}>
                  <Listbox value={paged} onChange={setPaged}>
                    <div className="relative mt-1">
                      <Listbox.Button className="scale-[0.97] relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left border border-slate-400/25 focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm">
                        <span className="block truncate"> {`Page ${paged}`}</span>
                        <span className="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                          <ChevronUpDownIcon
                            className="h-5 w-5 text-gray-400"
                            aria-hidden="true"
                          />
                        </span>
                      </Listbox.Button>
                      <Transition
                        as={Fragment}
                        leave="transition ease-in duration-100"
                        leaveFrom="opacity-100"
                        leaveTo="opacity-0"
                      >
                        <Listbox.Options className="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                          {users.map((user, key) => (
                            <Listbox.Option
                              key={key}
                              className={({ active }) =>
                                `relative select-none py-2 pl-10 block pr-4 cursor-pointer ${
                                  active ? 'bg-green-100 text-green-900' : 'text-slate-800'
                                }`
                              }
                              value={key}
                            >
                              {({ selected }) => (
                                <>
                                  <span
                                    className={`block cursor-default truncate ${
                                      selected ? 'font-semibold' : 'font-medium'
                                    }`}
                                  >
                                    {`Page ${key}`}
                                  </span>
                                  {selected ? (
                                    <span className="absolute inset-y-0 left-0 cursor-pointer  flex items-center pl-3 text-green-600">
                                      <CheckIcon className="h-5 w-5" aria-hidden="true" />
                                    </span>
                                  ) : null}
                                </>
                              )}
                            </Listbox.Option>
                          ))}
                        </Listbox.Options>
                      </Transition>
                    </div>
                  </Listbox>
                </div>
            </div>
            {/* menu::end */}

          {/* users::start */}
            {tab &&
              <Fragment>
                <div className="relative p-4 grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-3">
                  {users[paged] && users[paged].map(user => {
                      const websites = user.websites ? JSON.parse(user.websites) : [];
                      return(
                          <div key={user.id}  className="relative bg-white border border-slate-400/25 rounded-md p-3 w-full mx-auto cursor-pointer hover:shadow-lg transition-all duration-200 shadow-slate-200 ">
                              <div className="absolute right-3 top-3">
                                  {user.email ?
                                      <div className="font-poppins text-sm font-medium text-slate-600 md:w-auto w-full lg:max-w-[14rem] md:max-w-[12rem] max-w-[8rem] truncate">{user.email.substring(0,125)}</div>
                                  :
                                      <div className="h-3 animate-pulse bg-slate-200 rounded col-span-1"></div>
                                  }
                              </div>
                              <div className=" flex space-x-4">
                                  {user.thumb ?
                                      <img className="rounded-full shadow drop-shadow shadow-slate-200 bg-slate-200 h-20 w-20" src={user.thumb} alt={user.title} />
                                  :
                                      <div className="animate-pulse rounded-full bg-slate-200 h-20 w-20"></div>
                                  }
                                  <div className="flex-1 space-y-3 py-1">
                                      {(websites && getDomain(websites[0])) ?
                                          <div className="relative  h-5 w-5 bg-green-400 rounded-full flex justify-center items-center">
                                              <span className="font-poppins text-xs font-medium text-white leading-none whitespace-nowrap">{websites.length}</span>
                                          </div>
                                      :
                                          <div className="relative  h-5 w-5 bg-green-400 rounded-full flex justify-center items-center">
                                              <span className="font-poppins text-xs font-medium text-white leading-none whitespace-nowrap">0</span>
                                          </div>
                                      }
                                      <div className="space-y-3">
                                          <div className="grid grid-cols-3 gap-4">
                                              { (websites && getDomain(websites[0])) ?
                                                  <div className="font-poppins text-sm font-medium text-slate-600 col-span-3 md:w-auto w-full max-w-xs truncate">{`${(websites[0] && getDomain(websites[0])) ? getDomain(websites[0]) : ""}  ${(websites[1] && getDomain(websites[1])) ? ", "+getDomain(websites[1]) : ""}`}</div>
                                              :
                                                  <>
                                                      <div className="h-3 animate-pulse bg-slate-200 rounded col-span-2 w-2/3 mt-2"></div>
                                                  </>
                                              }
                                          </div>

                                          <div className="grid grid-cols-3 gap-4 ">
                                              <div className="h-3 animate-pulse bg-slate-200 rounded col-span-1"></div>
                                              <div className="h-3 animate-pulse bg-slate-200 rounded col-span-2"></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      )
                  })}
                </div>
              </Fragment>
            }
          {/* users::end */}


          {/* licence::start */}
          {!tab &&
              <Fragment>
                <div className="relative p-4 grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-3">
                  {licenses[licensePaged] && licenses[licensePaged].map(license => {
                      return(
                          <div key={license.id}  className="relative bg-white border border-slate-400/25 rounded-md p-3 w-full mx-auto cursor-pointer hover:shadow-lg transition-all duration-200 shadow-slate-200 ">
                              <div className="absolute right-3 top-3">
                                  { license.websites != "" ?
                                    <div className="font-poppins text-sm font-medium text-slate-600 md:w-auto w-full lg:max-w-[14rem] md:max-w-[12rem] max-w-[8rem] truncate">{`${(license.websites && getDomain(license.websites)) ? getDomain(license.websites) : "Deactivated" }`}</div>
                                  :
                                    <div className="h-3 animate-pulse bg-slate-200 rounded col-span-1"></div>
                                  }
                              </div>
                              <div className=" flex space-x-4">
                                  <div className="animate-pulse rounded-full bg-slate-200 h-20 w-20"></div>
                                    <div className="flex-1 space-y-3 py-1">
                                      {
                                        (license.websites != "" && license.websites != null) ?
                                          <div className="relative  h-5 w-5 bg-green-400 rounded-full flex justify-center items-center">
                                              <span className="font-poppins text-xs font-medium text-white leading-none whitespace-nowrap"></span>
                                          </div>
                                        :
                                        <div className="relative  h-5 w-5 bg-red-400 rounded-full flex justify-center items-center">
                                            <span className="font-poppins text-xs font-medium text-white leading-none whitespace-nowrap"></span>
                                        </div>
                                      }
                                      <div className="space-y-3">
                                          <div className="grid grid-cols-3 gap-4">
                                              { license.key ?
                                                <Fragment>
                                                  <div className={`${navigator && "pr-8"} font-poppins text-sm font-medium text-slate-600 col-span-3 md:w-auto w-full max-w-xs truncate`}>{license.key}</div>
                                                  {
                                                    navigator &&
                                                    <Fragment>
                                                      <ClipboardDocumentCheckIcon id={`license_${licensePaged}_${license.id}`} className='opacity-0 h-5 w-5 block text-green-400 transition-all duration-150 scale-105 absolute right-4' />
                                                      <span className='transition-all duration-150 absolute right-4 block' data-id={`license_${licensePaged}_${license.id}`} data-license={license.key} onClick={(e) => copyToClipboard(e)} >
                                                        <ClipboardDocumentIcon className='h-5 w-5 pointer-events-none' />
                                                      </span>
                                                    </Fragment>
                                                  }
                                                </Fragment>
                                              :
                                                  <>
                                                      <div className="h-3 animate-pulse bg-slate-200 rounded col-span-2 w-2/3 mt-2"></div>
                                                  </>
                                              }
                                          </div>

                                          <div className="grid grid-cols-3 gap-4 ">
                                              <div className="h-3 animate-pulse bg-slate-200 rounded col-span-1"></div>
                                              <div className="h-3 animate-pulse bg-slate-200 rounded col-span-2"></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      )
                  })}
                </div>
              </Fragment>
            }
          {/* licence::end */}


        </>
    );
}

export default Dashboard;
