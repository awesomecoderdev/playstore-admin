import React, { useEffect, useState } from 'react';
import { Cog6ToothIcon, KeyIcon, PaintBrushIcon, Squares2X2Icon } from '@heroicons/react/24/outline';
import { Switch } from '@headlessui/react'
import { post_types,posts, ajaxurl, headers } from './Backend';
import axios from 'axios';

const Dashboard = () => {
    const [posts, setPosts] = useState([]);
    const [enabled, setEnabled] = useState(false);

    useEffect(() => {
        axios.post(ajaxurl, {
            path: "posts"
        },headers)
        .then(function (response) {
            const res = response.data;
            console.log(response);
            setPosts(res.posts)
        })
        .catch(function (error) {
          console.log(error);
        });
    }, []);

    console.log('====================================');
    console.log(posts);
    console.log('====================================');

    return (
        <>
            {/* menu::start */}
            <div className="relative bg-white w-full flex items-center px-5 py-3">
                <span className='mr-2 bg-white cursor-pointer flex items-center p-2 rounded-md border border-slate-400/25 transform translate-y-0 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 shadow-slate-200 '>
                    <Squares2X2Icon className="h-5 pointer-events-none text-slate-500 mr-2"/>Dashboard
                </span>
                <span className='mr-2 bg-white cursor-pointer flex items-center p-2 rounded-md border border-slate-400/25 transform translate-y-0 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 shadow-slate-200 '>
                    <PaintBrushIcon className="h-5 pointer-events-none text-slate-500 mr-2"/>Post Types
                </span>
                <span className='mr-2 bg-white cursor-pointer flex items-center p-2 rounded-md border border-slate-400/25 transform translate-y-0 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 shadow-slate-200 '>
                    <Cog6ToothIcon className="h-5 pointer-events-none text-slate-500 mr-2"/>Settings
                </span>
                <span className='mr-2 bg-white cursor-pointer flex items-center p-2 rounded-md border border-slate-400/25 transform translate-y-0 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 shadow-slate-200 '>
                    <KeyIcon className="h-5 pointer-events-none text-slate-500 mr-2"/>Activate
                </span>
            </div>
            {/* menu::end */}

            <div className="relative p-4 grid grid-cols-2 gap-3">
                {posts.map(post => {
                    return(
                        <div key={post.id}  className="relative bg-white border border-slate-400/25 rounded-md p-3 w-full mx-auto cursor-pointer hover:shadow-lg transition-all duration-200 shadow-slate-200 ">
                            <div className="absolute right-3 top-3">
                                <Switch
                                  checked={enabled}
                                  onChange={setEnabled}
                                  className={`${
                                    enabled ? 'bg-green-300' : 'bg-gray-200'
                                  } relative inline-flex h-6 w-11 items-center rounded-full outline-none active:outline-none`}
                                >
                                  <span
                                    className={`${
                                      enabled ? 'translate-x-6' : 'translate-x-1'
                                    } inline-block h-4 w-4 transform rounded-full bg-white transition  outline-none active:outline-none`}
                                  />
                                </Switch>
                            </div>
                            <div className=" flex space-x-4">
                                {post.thumb ?
                                    <img className="rounded-full shadow drop-shadow shadow-slate-200 bg-slate-200 h-20 w-20" src={post.thumb} alt={post.title} />
                                :
                                    <div className="animate-pulse rounded-full bg-slate-200 h-20 w-20"></div>
                                }
                                <div className="flex-1 space-y-6 py-1">
                                    {post.post_type ?
                                        <span className="font-poppins  text-xs font-medium leading-none h-auto text-white px-2 pb-1 bg-green-400 rounded-full whitespace-nowrap">{post.post_type}</span>
                                    :
                                        <div className="animate-pulse h-4 w-12 bg-slate-200 rounded "></div>
                                    }
                                    <div className="space-y-3">
                                        <div className="grid grid-cols-3 gap-4">
                                            {post.sub ?
                                                <div className="font-poppins text-xs font-light text-slate-500 col-span-3 tracking-wide">{post.sub}</div>
                                            :
                                                <>
                                                    <div className="h-3 animate-pulse bg-slate-200 rounded col-span-2"></div>
                                                    <div className="h-3 animate-pulse bg-slate-200 rounded col-span-1"></div>
                                                </>
                                            }
                                        </div>
                                        {post.title ?
                                            <div className="font-poppins text-sm font-medium text-slate-600">{post.title}</div>
                                        :
                                            <div className="animate-pulse h-3 bg-slate-200 rounded"></div>
                                        }
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
