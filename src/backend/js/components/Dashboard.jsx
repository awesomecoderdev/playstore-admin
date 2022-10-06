import React, { useEffect, useState } from 'react';
import { Cog6ToothIcon, KeyIcon, PaintBrushIcon, Squares2X2Icon } from '@heroicons/react/24/outline';
import { Switch } from '@headlessui/react'
import { post_types,users, ajaxurl, headers } from './Backend';
import axios from 'axios';
import { isArray } from 'lodash';

const Dashboard = () => {
    const [enabled, setEnabled] = useState(false);
    const [paged, setPaged] = useState(0);

    console.log(JSON.parse(users[0][0].websites));

    const getDomain = (href) => {
        if(href){
            const url = href.match(/^(https?\:)\/\/(([^:\/?#]*)(?:\:([0-9]+))?)([\/]{0,1}[^?#]*)(\?[^#]*|)(#.*|)$/);
            return ( url && url[2] && url[2] != null) ? url[2] : false;
        }else{
            return false;
        }
    }


    return (
        <>
            {/* menu::start */}
            <div className="relative bg-white w-full flex items-center px-5 py-3">
                <span className='mr-2 bg-white cursor-pointer flex items-center p-2 rounded-md border border-slate-400/25 transform translate-y-0 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 shadow-slate-200 '>
                    <Squares2X2Icon className="h-5 pointer-events-none text-slate-500 mr-2"/>Dashboard
                </span>
                {/* <span className='mr-2 bg-white cursor-pointer flex items-center p-2 rounded-md border border-slate-400/25 transform translate-y-0 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 shadow-slate-200 '>
                    <PaintBrushIcon className="h-5 pointer-events-none text-slate-500 mr-2"/>Post Types
                </span>
                <span className='mr-2 bg-white cursor-pointer flex items-center p-2 rounded-md border border-slate-400/25 transform translate-y-0 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 shadow-slate-200 '>
                    <Cog6ToothIcon className="h-5 pointer-events-none text-slate-500 mr-2"/>Settings
                </span> */}
                <span className='mr-2 bg-white cursor-pointer flex items-center p-2 rounded-md border border-slate-400/25 transform translate-y-0 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 shadow-slate-200 '>
                    <KeyIcon className="h-5 pointer-events-none text-slate-500 mr-2"/>License
                </span>
            </div>
            {/* menu::end */}

            <div className="relative p-4 grid grid-cols-2 gap-3">
                {users[paged] && users[paged].map(user => {
                    const websites = user.websites ? JSON.parse(user.websites) : [];
                    return(
                        <div key={user.id}  className="relative bg-white border border-slate-400/25 rounded-md p-3 w-full mx-auto cursor-pointer hover:shadow-lg transition-all duration-200 shadow-slate-200 ">
                            <div className="absolute right-3 top-3">
                                {user.email ?
                                    <div className="font-poppins text-sm font-medium text-slate-600">{user.email.substring(0,125)}</div>
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
                                    {websites ?
                                        <div className="relative  h-5 w-5 bg-green-400 rounded-full flex justify-center items-center">
                                            <span className="font-poppins text-xs font-medium text-white leading-none whitespace-nowrap">{websites.length}</span>
                                        </div>
                                    :
                                        <div className="animate-pulse h-4 w-12 bg-slate-200 rounded "></div>
                                    }
                                    <div className="space-y-3">
                                        <div className="grid grid-cols-3 gap-4">
                                            { (websites && getDomain(websites[0]))  ?
                                                <div className="font-poppins text-sm font-medium text-slate-600 col-span-3">{`${(websites[0] && getDomain(websites[0])) ? getDomain(websites[0]) : ""}  ${(websites[1] && getDomain(websites[1])) ? ", "+getDomain(websites[1]) : ""}`}</div>
                                            :
                                                <>
                                                    <div className="h-3 animate-pulse bg-slate-200 rounded col-span-2 w-2/3 mt-2"></div>
                                                </>
                                            }
                                        </div>

                                        <div className="grid grid-cols-3 gap-4">
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
        </>
    );
}

export default Dashboard;
